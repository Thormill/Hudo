<?php
class Database {
    private $connection;
    private $connected;
    private $host;
    private $user;
    private $pwd;
    private $dbname;
    private $names;
    private $lastError;
    private $lastQuery;
		
    public function __construct($host, $user, $pwd, $dbname, $names = 'utf8') {
        $this->host		= $host;
        $this->user		= $user;
        $this->pwd		= $pwd;
        $this->dbname	= $dbname;
        $this->names	= $names;
    }

    private function connect() {
        if ($this->connected)
            return $this->connection;
        $this->connection = @mysql_connect($this->host, $this->user, $this->pwd, true);
        if ($this->connection) {
            $dbselect = @mysql_select_db($this->dbname, $this->connection);
            if (!$dbselect) {
                @mysql_close($this->connection);
                die('Database error.');
            }
        } else
            die('Database error.');
        $this->connected = true;
        if ($this->names)
            @mysql_query('SET NAMES "'. $this->names .'"', $this->connection);
        return $this->connection;
    }
		
    public function __destruct() {
        if ($this->connected)
        @mysql_close($this->connection);
    }
		
    public function close() {
        if ($this->connected)
            return @mysql_close($this->connection);
        return false;
    }
		
    public function isConnected() {
        return $this->connected;
    }
	
    public function process($aArgs) {
        if (empty($aArgs))
            return '';
        if (!is_array($aArgs))
            $aArgs = func_get_args();
        $this->lastQuery = ' ' . array_shift($aArgs);
        if (empty($aArgs))
            return $this->lastQuery;
        foreach ($aArgs as $mArg) {
            if(!preg_match('/([^\\\\])\?(w|s|)/', $this->lastQuery, $aMatch))
                return $this->lastQuery;
            switch ($aMatch[2]) {
                case 'w':
                    if (is_array($mArg)) {
                        foreach($mArg as $mKey => $sArg) {
                            $mArg[$mKey] = str_replace('"', '\\"', $sArg);
                        }
                        $mArg = '"'. implode('","', $mArg) .'"';
                    } else {
                        $mArg = '"'. str_replace('"', '\\"', $mArg) .'"';
                    }
                    break;
                case 's':
                    if (is_array($mArg)) {
                        foreach($mArg as $mKey => $sArg) {
                            $mArg[$mKey] = str_replace('"', '\\"', $sArg);
                        }
                        $mArg = '"'. implode(',', $mArg) .'"';
                    } else {
                        $mArg = '"'. str_replace('"', '\\"', $mArg) .'"';
                    }
                    break;
                case '':
                    if (is_array($mArg))
                        $mArg = implode(',', $mArg);
            }
            $this->lastQuery = preg_replace(
                '/'. preg_quote($aMatch[0]) .'/',
                $aMatch[1] . str_replace('?', '\\?', $mArg),
                $this->lastQuery,
                1
            );
        }
        $this->lastQuery = str_replace('\\?', '?', $this->lastQuery);
        if (Database::$testQuery) {
            echo "<!--\n". $this->lastQuery ."\n-->";
            if(!preg_match('/^SELECT/', $this->lastQuery))
                return 'SELECT 1';
        }
        return $this->lastQuery;
    }
		
    public function insert() {
        if (!$this->connect())
            return false;
        if (!@mysql_query($this->process(func_get_args()), $this->connection)) {
            $this->lastError = @mysql_error($this->connection);
            return false;
        }
        return mysql_insert_id($this->connection);
    }
		
    public function query() {
        if (!$this->connect())
            return false;
        if (@mysql_query($this->process(func_get_args()), $this->connection))
            return true;
        $this->lastError = @mysql_error($this->connection);
            return false;
    }

    public function selectTable() {
        $out = array();
        if (!$this->connect())
            return $out;
        $q = @mysql_query($this->process(func_get_args()), $this->connection);
        if (!$q) {
            $this->lastError = @mysql_error($this->connection);
            return $out;
        }
        while ($result = @mysql_fetch_assoc($q)) {
            $out[] = $result;
        }
        if (strpos($this->lastQuery, 'SQL_CALC_FOUND_ROWS') !== false) {
            if ($q = @mysql_query('SELECT FOUND_ROWS()', $this->connection)) {
                if ($record = @mysql_fetch_row($q))
                    $this->rows = $record[0];
            }
        }
        return $out;
    }

    public function selectField() {
        if (!$this->connect())
            return null;
        $q = @mysql_query($this->process(func_get_args()), $this->connection);
        if (!$q) {
            $this->lastError = @mysql_error($this->connection);
            return null;
        }
        if ($record = @mysql_fetch_row($q))
            return $record[0];
        return null;
    }

    public function selectRecord() {
        if (!$this->connect())
            return array();
        $q = @mysql_query($this->process(func_get_args()), $this->connection);
        if (!$q) {
            $this->lastError = @mysql_error($this->connection);
            return array();
        }
        if ($record = @mysql_fetch_assoc($q))
            return $record;
        return array();
    }
		
    public function selectColumn() {
        $out = array();
        if (!$this->connect())
            return $out;
        $q = @mysql_query($this->process(func_get_args()), $this->connection);
        if (!$q) {
            $this->lastError = @mysql_error($this->connection);
            return $out;
        }
        while ($result = @mysql_fetch_row($q)) {
            $out[] = $result[0];
        }
        if (strpos($this->lastQuery, 'SQL_CALC_FOUND_ROWS') !== false) {
            if ($q = @mysql_query('SELECT FOUND_ROWS()', $this->connection)) {
                if ($record = @mysql_fetch_row($q))
                    $this->rows = $record[0];
            }
        }
        return $out;
    }
		
    public function getError() {
        return $this->lastError;
    }

    public function getLastQuery() {
        return $this->lastQuery;
    }

    public function getRowsQuantity() {
        return intval($this->rows);
    }
}
