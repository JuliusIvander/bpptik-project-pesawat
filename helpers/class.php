<?php

class Index
{
    private array $container = [];

    # Convert json into array
    private function collectJsonData($path)
    {
        $json_data = file_get_contents($path);
        return json_decode($json_data, true);
    }

    # Count function
    private function count($value_a, $value_b)
    {
        return $value_a + $value_b;
    }

    # Store data to json
    public function store($post)
    {
        # Set container for data storage
        $this->container = [
            $post["maskapai"],
            $post["bandara_asal"],
            $post["bandara_tujuan"],
            $post["harga"]
        ];

        # Get datas
        [$raw_data, $pajak_bandara] = $this->fetchData();

        // # Count pajak and total
        $pajak = $this->count(
            $pajak_bandara["bandara_asal"][$post["bandara_asal"]],
            $pajak_bandara["bandara_tujuan"][$post["bandara_tujuan"]]
        );
        $total = $this->count($pajak, $post["harga"]);

        array_push($this->container, $pajak, $total); # Pushing $pajak and $total to container
        array_push($raw_data, $this->container); # Pushing data to json data

        # Sort data
        usort($raw_data, function ($a, $b) {
            return $a[0] <=> $b[0];
        });

        # decode data
        $data_path = realpath(__DIR__) . "\..\datas\data.json";
        $decode_data = json_encode($raw_data, JSON_PRETTY_PRINT);
        file_put_contents($data_path, $decode_data); # update json file
    }

    # Getting json data
    public function fetchData()
    {
        # Initiate json path
        $raw_path = realpath(__DIR__) . "\..\datas\data.json";
        $bandara_path = realpath(__DIR__) . "\..\datas\data_bandara.json";

        # Collect and convert json into array
        $raw_data = $this->collectJsonData($raw_path);
        $bandara_data = $this->collectJsonData($bandara_path);
        return [$raw_data, $bandara_data];
    }
}
