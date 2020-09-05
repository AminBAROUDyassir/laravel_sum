<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sum_array extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:array_sum {args}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command give you the sum of all numbers in array that is put as argument ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $arguments = $this->argument("args");

        $final_result = self::get_sum($arguments);

        //info($final_result);
        $this->info($final_result);

    }

    public function get_sum($array)
    {
        $result = 0;
        if (!is_array($array)) {
            $array_cal = json_decode($array, true);
        } else {
            $array_cal = $array;
        }

        if (is_array($array_cal)) {
            info("i am jsut above this number  ");

            foreach ($array_cal as $items) {
                if (is_array($items)) {
                    $result = $result + self::get_sum($items);
                } else {
                    $result = $result + $items;
                }

            }
            return $result;
        } else {
            return $result;
        }

    }
}
