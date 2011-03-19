Simple caching mechanism
========================

Stores the cache file in the predefined cache directory with the filename consisting of prefix + md5 of the cache key.

Example usage
-------------

	$sql_cache = new FileCache('query_result', 86400, '.');

	$sql = 'SELECT fields FROM a_table WHERE conditions_apply';
	if ($sql_cache->has($sql)) {
		$results = $sql_cache->get($sql);
	}
	else {
		$results = $db->execute($sql);
	}

OR

	$sql_cache = new FileCache('query_result', 60);

	$sql = 'SELECT fields FROM a_table WHERE conditions_apply';
	$results = $sql_cache->get($sql);
	if (!$results) {
		$results = $db->execute($sql);
	}

OR

	$sql_cache = new FileCache('query_result');

	$sql = 'SELECT fields FROM a_table WHERE conditions_apply';
	$results = $sql_cache->get($sql) ?: $db->execute($sql); // PHP 5.3 or later
