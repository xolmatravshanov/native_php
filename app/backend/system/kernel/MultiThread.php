<?php


/*
 *
 * Requirement
 * extension=php_pthreads.dll // windows
 * extension=pthreads.so // linux
 * */

class MultiThread extends Thread
{

    private $message;


    public function __construct(string $message)
    {
        // Set the message value for this particular instance.
        $this->message = $message;
    }

    // The operations performed in this function is executed in the other thread.
    public function run()
    {
        echo $this->message;
    }


    public function example()
    {
        // Instantiate MyThread
        $myThread = new self("Hello from an another thread!");
        // Start the thread. Also it is always a good practice to join the thread explicitly.
        // Thread::start() is used to initiate the thread,
        $myThread->start();
        // and Thread::join() causes the context to wait for the thread to finish executing
        $myThread->join();
    }

}