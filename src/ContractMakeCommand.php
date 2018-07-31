<?php

namespace CwcCode\LaravelContracts;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ContractMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract';

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($rawName);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/contract.stub';
    }

    /**
     * Get the method stub file.
     *
     * @return string
     */
    protected function getMethodStub()
    {
        return __DIR__.'/../stubs/contract-method.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Contracts';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $methods = [];

        if ($this->hasOption('method')) {
            $methodNames = \is_string($this->option('method'))
                ? [$this->option('method')]
                : $this->option('method');

            foreach ($methodNames as $methodName) {
                $methods[] = str_replace('METHOD', $methodName, $this->files->get($this->getMethodStub()));
            }
        }

        if (empty($methods)) {
            $methods = ['    //'];
        }

        $stub = str_replace('DummyMethods', implode("\n\n", $methods), $stub);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['method', 'm', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Generate an interface with the given method.'],
        ];
    }
}