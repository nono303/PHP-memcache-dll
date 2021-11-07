<?php
	class MemcacheSessionHandler implements \SessionHandlerInterface {
		private $memcache;
		private $ttl;
		private $prefix;

		public function __construct(array $options = array() ) {
			$this->memcache = new MemcachePool();
			if ( $diff = array_diff( array_keys( $options ), array( 'prefix', 'expiretime' ) ) ) 
				throw new \InvalidArgumentException( sprintf('The following options are not supported "%s"',implode( ', ', $diff )));
			$this->ttl    = isset( $options[ 'expiretime' ] ) ? (int)$options[ 'expiretime' ] : ini_get("session.gc_maxlifetime");
			$this->prefix = isset( $options[ 'prefix' ] ) ? $options[ 'prefix' ] : 'sf2s-';
		}

		public function open( $savePath, $sessionName ) : bool {
			$this->memcache->connect('127.0.0.1', 11211, $udp_port = 0, $persistent = true, $weight = 1, $timeout = 1, $retry_interval = 15);
			return true;
		}

		public function close() : bool {
			$this->memcache->close();
			return true;
		}
		public function read( $sessionId ) : string|false {
			return $this->memcache->get( $this->prefix . $sessionId ) ? : '';
		}

		public function write( $sessionId, $data ) : bool {
			/* 
				!! ttl is the third parameter with memcached.
				http://php.net/manual/fr/memcache.set.php
				http://php.net/manual/fr/memcached.set.php
			*/
			return $this->memcache->set( $this->prefix . $sessionId, $data, $flag = 0, time() + $this->ttl );
		}

		public function destroy( $sessionId ) : bool {
			return $this->memcache->delete( $this->prefix . $sessionId );
		}

		public function gc( $lifetime ) : int|false {
			return true;
		}
	}
	session_set_save_handler(new MemcacheSessionHandler(array('prefix' => 'phpses-')), true);
?>