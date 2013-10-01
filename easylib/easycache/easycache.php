<?php
namespace easylib\easycache;
class easycache
{
	private $cache = false;
	public function __construct()
	{
		$c = new config();
		if (function_exists('apc_add')&&$c->get("caching"))
		{
			$this->cache=true;
		}
	}
	public function add($key, $value, $ttl = 120)
	{
		if($this->cache)
		{
			apc_add($key, $value, $ttl);
		}
	}
	public function get($key)
	{
		if($this->cache)
		{
			if(apc_exists($key))
			{
				return apc_fetch($key);
			}
		}
		return false;
	}
	public function del($key)
	{
		if($this->cache)
		{
			if(apc_exists($key))
			{
				apc_delete($key);
			}
		}
	}
	public function clear()
	{
		if($this->cache)
		{
			apc_clear_cache('user');
		}
	}
	public function useCache()
	{
		if($this->cache)
		{
			return true;
		}
		return false;
	}
	public function info()
	{
		if($this->cache)
		{
			return apc_cache_info("user");
		}
	}
}
?>