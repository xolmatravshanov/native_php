<?php
// This is the *Work* which would be ran by the worker.
// The work which you'd want to do in your worker.
// This class needs to extend the \Threaded or \Collectable or \Thread class.
class AwesomeWork extends Thread {

    private $workName;

    /**
     * @param string $workName
     * The work name wich would be given to every work.
     */

    public function __construct(string $workName) {
        // The block of code in the constructor of your work,
        // would be executed when a work is submitted to your pool.

        $this->workName = $workName;
        printf("A new work was submitted with the name: %s\n", $workName);

    }

    public function run() {
        // This block of code in, the method, run
        // would be called by your worker.
        // All the code in this method will be executed in another thread.
        $workName = $this->workName;
        printf("Work named %s starting...\n", $workName);
        printf("New random number: %d\n", mt_rand());
    }


}

// Create an empty worker for the sake of simplicity.
class AwesomeWorker extends Worker {

    public function run() {

        // You can put some code in here, which would be executed

        // before the Work's are started (the block of code in the `run` method of your Work)

        // by the Worker.

        /* ... */

    }

}

// Create a new Pool Instance.

// The ctor of \Pool accepts two parameters.

// First: The maximum number of workers your pool can create.

// Second: The name of worker class.

$pool = new \Pool(1, \AwesomeWorker::class);

// You need to submit your jobs, rather the instance of
// the objects (works) which extends the \Threaded class.
$pool->submit(new \AwesomeWork("DeadlyWork"));

$pool->submit(new \AwesomeWork("FatalWork"));

// We need to explicitly shutdown the pool, otherwise,

// unexpected things may happen.

// See: http://stackoverflow.com/a/23600861/23602185

$pool->shutdown();