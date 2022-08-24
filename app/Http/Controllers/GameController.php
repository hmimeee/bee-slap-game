<?php

namespace App\Http\Controllers;

use App\Models\Bee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->bee = Bee::where('points', '>', 0)->inRandomOrder()->first();
        $this->deductions = [
            'queen' => 7,
            'worker' => 12,
            'drone' => 18
        ];
        $this->bees = Bee::all();

        return view('index', $this->data);
    }

    /**
     * Hit the bee and deduct the points
     *
     * @param \App\Models\Bee $bee
     * @return mixed
     */
    public function hit(Bee $bee)
    {
        $deductions = [
            'queen' => 7,
            'worker' => 12,
            'drone' => 18
        ];

        //Update the current bee points
        $bee->update(['points' => DB::raw('GREATEST(points - ' . $deductions[$bee->type] . ', 0)')]);

        //Check whether any queen alive or not
        $aliveQueens = Bee::whereType('queen')->where('points', '>', 0)->count();

        //If not alive any queen, kill all bees
        if (!$aliveQueens)
            Bee::query()->update([
                'points' => 0
            ]);

        return back()->withSuccess('You\'ve hit the bee: ' . $bee->name);
    }

    /**
     * Reset the game data
     *
     * @return mixed
     */
    public function reset()
    {
        Artisan::call('db:seed');

        return back()->withSuccess('Game reset successfully');
    }
}
