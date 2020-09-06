<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class string_replace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:string_replace {args*} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "The command will take two arguments,
    First: string with elements to replace with its arguments, your have template pattern {} and inside the index of argument
    exp: '{1}_{0}'
    Second: list of arguments, exp: {1} {0}";

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

        $array = $this->argument('args');

        $final_result = self::str_replace($array);
        $this->info($final_result);
    }

    public function str_replace($array)
    {
        if (count($array) > 1) {

            $get_form = explode("_", $array[0]);

            $i = 0;
            $arr_ints = [];

            foreach ($get_form as $element) {

                $val = filter_var($element, FILTER_SANITIZE_NUMBER_INT);

                if (is_numeric($val)) {
                    $arr_vals[$i] = $val;
                } else {
                    $arr_vals[$i] = $element;
                }
                $i++;
            }

            //asort($arr_vals);
            info($arr_vals);

            $j = 0;
            $result = "";
            foreach ($arr_vals as $x => $x_value) {

                if (is_numeric($x_value)) {

                    if (!isset($array[$x_value + 1])) {
                        $value = "";
                    } else {
                        $value = $array[$x_value + 1];
                    }

                    if ($j == 0) {
                        $result = $value;
                    } else {
                        $result = $result . "_" . $value;
                    }

                } else {

                    if ($j == 0) {
                        $result = $x_value;
                    } else {
                        $result = $result . "_" . $x_value;
                    }

                }
                $j++;
            }

            return $result;

        }

    }
}
