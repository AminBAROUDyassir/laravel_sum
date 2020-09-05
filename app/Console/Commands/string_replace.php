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
    protected $signature = 'run:string_replace {form} {args1} {args2}';

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

        $form = $this->argument("form");
        $args1 = $this->argument("args1");
        $args2 = $this->argument("args2");

        $final_result = self::str_replace($form, $args1, $args2);

        //info($final_result);
        $this->info($final_result);
    }

    public function str_replace($form, $args1, $args2)
    {

        $get_form = explode("_", $form);

        $first = (int) filter_var($get_form[0], FILTER_SANITIZE_NUMBER_INT);
        $second = (int) filter_var($get_form[1], FILTER_SANITIZE_NUMBER_INT);

        if ($first > $second) {
            return $args2 . "_" . $args1;
        } else {
            return $args1 . "_" . $args2;
        }

    }
}
