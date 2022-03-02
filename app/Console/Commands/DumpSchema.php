<?php namespace Phpleaks\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DumpSchema extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:dumpschema';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Dumps the MySQL Schema to tests/_data';

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
	 * @return mixed
	 */
	public function fire()
	{

		$path = base_path() . '/tests/_data/dump.sql';
		$mysqldump_path = trim(`which mysqldump`);
		
		$command = $mysqldump_path . ' --no-data -u ' . env('DB_USERNAME') . ' -p' . env('DB_PASSWORD'). ' ' . env('DB_DATABASE') . ' > ' . $path;
		$this->info($command);
		system($command);
		$this->info('Database schema exported!'); 
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		];
	}

}
