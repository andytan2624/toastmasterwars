<?php

trait Factory
{
    protected $namespace = 'App\Models\\';
    protected $times = 1;
    /**
     * @param $type
     * @param array $fields
     */
    protected function make($type, array $fields = []) {
        while ($this->times--)
        {
            $stub = array_merge($this->getStub(), $fields);

            $model_name = $this->namespace.$type;
            $model_name::create($stub);
        }
    }

    protected function getStub() {
        throw new BadMethodCallException('Create your own getStub method to declare your fields.');
    }


    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

}