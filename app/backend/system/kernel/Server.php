<?php

class Server
{

    private $host = '127.0.0.1';

    private $port = 5000;

    public function __construct()
    {
        $this->create();
    }


    public function create()
    {

        set_time_limit(0); // disable timeout
        ob_implicit_flush(); // disable output caching


        /*
            function socket_create ( int $domain , int $type , int $protocol )
            $domain can be AF_INET, AF_INET6 for IPV6 , AF_UNIX for Local communication protocol
            $protocol can be SOL_TCP, SOL_UDP  (TCP/UDP)
            @returns true on success
        */

        if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
            echo "Couldn't create socket" . socket_strerror(socket_last_error()) . "\n";
        }


        /*
            socket_bind ( resource $socket , string $address [, int $port = 0 ] )
            Bind socket to listen to address and port
        */

        if (socket_bind($socket, $this->host, $this->port) === false) {
            echo "Bind Error " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        if (socket_listen($socket, 5) === false) {
            echo "Listen Failed " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        do {
            if (($msgsock = socket_accept($socket)) === false) {
                echo "Error: socket_accept: " . socket_strerror(socket_last_error($socket)) . "\n";
                break;
            }

            /* Send Welcome message. */
            $msg = "\nPHP Websocket \n";

            // Listen to user input
            do {
                if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
                    echo "socket read error: " . socket_strerror(socket_last_error($msgsock)) . "\n";
                    break 2;
                }
                if (!$buf = trim($buf)) {
                    continue;
                }

                // Reply to user with their message
                $talkback = "PHP: You said '$buf'.\n";
                socket_write($msgsock, $talkback, strlen($talkback));
                // Print message in terminal
                echo "$buf\n";

            } while (true);
            socket_close($msgsock);
        } while (true);

        socket_close($socket);

    }
    
    
    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }


}