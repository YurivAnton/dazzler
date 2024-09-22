<?php

class SpilledCoffee {
    private $table;
    private $visited;
    private $rows;
    private $cols;

    public function __construct(array $table) {
        $this->table = $table;
        $this->rows = count($table);
        $this->cols = count($table[0]);
        $this->visited = array_fill(0, $this->rows, array_fill(0, $this->cols, false));
    }

    public function findLargestPuddleAndCount() {
        $maxSize = 0;
        $puddleCount = 0;

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                if ($this->table[$i][$j] == 1 && !$this->visited[$i][$j]) {
                    $size = $this->dfs($i, $j);
                    $maxSize = max($maxSize, $size);
                    if($size > 1){
                        $puddleCount++;
                    }
                }
            }
        }

        return [$maxSize, $puddleCount];
    }

    private function dfs($x, $y) {
        if ($x < 0 || $x >= $this->rows || $y < 0 || $y >= $this->cols || $this->visited[$x][$y] || $this->table[$x][$y] == 0) {
            return 0;
        }
        
        $this->visited[$x][$y] = true;
        $size = 1;

        $directions = [
            [-1, 0], [1, 0], [0, -1], [0, 1],
            [-1, -1], [-1, 1], [1, -1], [1, 1]
        ];
        
        foreach ($directions as $dir) {
            $size += $this->dfs($x + $dir[0], $y + $dir[1]);
        }

        return $size;
    }
}

$table = [];
for($i=0; $i<10; $i++){
    $arr = [];
    for($j=0; $j<10; $j++){
        if(mt_rand(0, 100) % 5 == 0){
            $arr[] = 1;
        } else {
            $arr[] = 0;
        }
    }
    $table[] = $arr;
}

$spilledCoffee = new SpilledCoffee($table);

$table[] = $spilledCoffee->findLargestPuddleAndCount();

echo json_encode($table);