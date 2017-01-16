<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core {

	private $CI;
	private $_path;
	private $_url;
	private $_images;
	
	public function __construct()
	{
		global $CFG;
		$this->CI =& get_instance();
		$this->_path = $CFG->config['manga_path'];
		$this->_images = "Pictures";
	}

	// Database - Start -
	private function insert($table, $data)
	{
		$this->CI->db->empty_table($table);
		return $this->CI->db->insert_batch($table, $data);
	}

	public function info_manga($url)
	{
		$this->CI->db->where('url', $url);
		$result = $this->CI->db->get('manga')->result();
		return $result ? $result[0] : show_404();
	}

	public function info_chapter($url)
	{
		$this->CI->db->where('url', $url);
		$result = $this->CI->db->get('chapter')->result();
		return $result ? $result[0] : show_404();
	}

	public function list_manga()
	{
		$status = "case when url not in (select path from bookmark) then 'unread' else 'readed' end as status";
		$this->CI->db->select("*, {$status}");
		$this->CI->db->order_by('name', 'ASC');
		return $this->CI->db->get('manga')->result();
	}

	public function list_chapter()
	{
		$query = $this->CI->db->query('SELECT * FROM chapter ORDER BY chapter +0 DESC');
		return $query->result();
	}

	public function read_chapter($chapter_url)
	{
		$this->CI->db->where('url', $chapter_url);
		$result = $this->CI->db->get('chapter')->result();
		if ($result) :
			$this->open_zip($result[0]->manga, $result[0]->path);
			return $this->read_images();
		endif;
	}

	public function index_chapter($chapter_url)
	{
		$chapter = $this->CI->db->query('SELECT * FROM chapter ORDER BY chapter +0 ASC')->result_array();
		$index = array_search($chapter_url, array_column($chapter, 'url'));
		$page = (object) array(
			'next'	=> ($index == count($chapter) - 1) ? FALSE : $index + 1,
			'prev'	=> ($index > 0) ? $index - 1 : FALSE
			);
		$default = array(
			'url'	=> ''
			);
		$result = (object) array(
			'next'	=> ($page->next === FALSE) ? $default : $chapter[$page->next],
			'prev'	=> ($page->prev === FALSE) ? $default : $chapter[$page->prev]
			);
		return $result;
	}

	public function list_bookmark()
	{
		$this->CI->db->select('b.*');
		$this->CI->db->join('manga as m', 'm.url = b.path');
		$this->CI->db->order_by('b.manga', 'ASC');
		return $this->CI->db->get('bookmark as b')->result();
	}

	public function data_manga()
	{
		$select = (object) array(
			'manga'		=> 'count(*) as manga',
			'unread'	=> 'sum(case when url not in (select path from bookmark) then 1 else 0 end) as unread',
			'readed'	=> 'sum(case when url in (select path from bookmark) then 1 else 0 end) as readed'
			);
		$this->CI->db->select("$select->manga, $select->unread, $select->readed");
		return $this->CI->db->get('manga')->result();
	}

	public function initialize_bookmark()
	{
		$query = "DELETE FROM bookmark WHERE path NOT IN (SELECT url FROM manga)";
		return $this->CI->db->query($query);
		
	}

	public function add_bookmark($data)
	{
		$check = $this->CI->db->where('path', $data['path'])->count_all_results('bookmark');
		if ($check >= 1) :
			$this->CI->db->where('path', $data['path']);
			$add = $this->CI->db->update('bookmark', $data);
		else :
			$add = $this->CI->db->insert('bookmark', $data);
		endif;
		return $add;
	}

	public function bookmarked($manga)
	{
		$check = $this->CI->db->where('path', $manga)->get('bookmark')->result();
		return $check ? $check[0] : FALSE;
	}

	public function search($keywords)
	{
		$status = "case when url not in (select path from bookmark) then 'unread' else 'readed' end as status";
		$this->CI->db->select("*, {$status}");
		$this->CI->db->order_by('name', 'ASC');
		$this->CI->db->like('name', $keywords);
		return $this->CI->db->get('manga')->result();
	}
	// Database - End -

	public function scan_dir()
	{
		$_dir = scandir($this->_path);
		foreach ($_dir as $item) :
			if ($item === '.' || $item === '..') continue;
			$result[] = array(
				'name'	=> $item,
				'path'	=> $item,
				'url'	=> url_title($item, '-', TRUE)
				);
		endforeach;
		$this->insert('manga', $result);
	}

	public function scan_chapter($path)
	{
		$_path = "{$this->_path}\\{$path}";
		$_length = strlen($path) + 1;
		$_dir = scandir($_path);
		foreach ($_dir as $item) :
			if ($item === '.' || $item === '..' || $item === 'info.txt' || $item === 'tags.txt') continue;
			$result[] = array(
				'manga'		=> $path,
				'chapter'	=> $this->get_number($item, $_length),
				'path'		=> $item,
				'url'		=> url_title(substr($item, 0, -4), '-', TRUE)
				);
		endforeach;
		$this->insert('chapter', $result);
	}

	public function open_zip($manga, $chapter)
	{
		$this->del_images();
		$zip = new ZipArchive();
		$open = $zip->open("{$this->_path}/{$manga}/{$chapter}");

		if ($open) :
			$zip->extractTo($this->_images."/");
			$zip->close();
		endif;
	}

	public function read_images()
	{
		$_images = scandir($this->_images);
		foreach ($_images as $item) :
			if ($item === '.' || $item === '..') continue;
			$images[] = base_url("{$this->_images}/{$item}");
		endforeach;
		return $images;
	}

	public function del_images()
	{
		array_map('unlink', glob("{$this->_images}/*.*"));
	}

	private function get_number($string, $length)
	{
		preg_match('/(^[0-9]*\.*[0-9])/', substr($string, $length), $find);
		return $find[1];
	}
}
