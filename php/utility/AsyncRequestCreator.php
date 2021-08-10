<?php

/**
 * Create async curl requests
 * Source: https://gonzalo123.com/2010/10/11/speed-up-php-scripts-with-asynchronous-database-queries/
 */
final class AsyncRequestCreator
{
    private array $handles = [];

    /** @var \CurlMultiHandle|false|resource */
    private $multiHandle;

    public function __construct()
    {
        $this->multiHandle = curl_multi_init();
    }

    public function add($url): AsyncRequestCreator
    {
        $url = 'http://localhost/veritas-migration/async/' . $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3000); // After how much time the script goes on
        curl_multi_add_handle($this->multiHandle, $ch);
        $this->handles[] = $ch;
        return $this;
    }

    public function runAllRequests(): array
    {
        // Request that have to still be ran
        $running = null;
        do {
            $status = curl_multi_exec($this->multiHandle, $running);
            usleep(250000); // 0.25s
        } while ($status === CURLM_CALL_MULTI_PERFORM || $running);

        for($i=0, $iMax = count($this->handles); $i < $iMax; $i++) {
            $out = curl_multi_getcontent($this->handles[$i]);
            $data[$i] = $out; // json_decode($out, true);
            curl_multi_remove_handle($this->multiHandle, $this->handles[$i]);
        }
//        foreach ($this->handles as $i => $c) {
//            $out = curl_multi_getcontent($this->handles[$i]);
//            $data[$i] = json_decode($out, true);
//            curl_multi_remove_handle($this->multiHandle, $this->handles[$i]);
//        }
        curl_multi_close($this->multiHandle);
        return $data;
    }
}
