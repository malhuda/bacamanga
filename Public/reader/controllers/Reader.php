<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reader extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('core');
	}

	public function index()
	{
		$data = [
			'list_bookmark'	=> $this->core->list_bookmark(),
			'list_manga'	=> $this->core->list_manga()
			];
		$this->load->view('home', $data);
	}

	public function manga($manga)
	{
		$info = $this->core->info_manga($manga);
		$this->core->scan_chapter($info->path);
		$data = [
			'title'			=> $info->name,
			'list_manga'	=> $this->core->list_manga(),
			'list_chapter'	=> $this->core->list_chapter(),
			'bookmarked'	=> $this->core->bookmarked($manga)
			];
		$this->load->view('layout/header', $data);
		$this->load->view('manga');
		$this->load->view('layout/footer');
	}

	public function read($manga, $chapter)
	{
		$info = $this->core->info_chapter($chapter);
		$data = [
			'title'			=> "{$info->manga} {$info->chapter}",
			'list_manga'	=> $this->core->list_manga(),
			'list_chapter'	=> $this->core->list_chapter(),
			'images'		=> $this->core->read_chapter($chapter),
			'page'			=> $this->core->index_chapter($chapter)
			];
		$this->load->view('layout/header', $this->add_data($data));
		$this->load->view('read');
		$this->load->view('layout/footer');
	}

	public function bookmark($manga, $chapter)
	{
		$info = $this->core->info_manga($manga);
		$this->core->scan_chapter($info->path);
		redirect(base_url("manga/{$manga}/{$chapter}"));
	}

	public function update()
	{
		$this->core->scan_dir();
		redirect(base_url());
	}

	public function add_bookmark($manga, $chapter)
	{
		$manga = $this->core->info_manga($manga);
		$chapter = $this->core->info_chapter($chapter);
		$data = [
			'manga'		=> $manga->name,
			'chapter'	=> $chapter->chapter,
			'path'		=> $manga->url,
			'url'		=> $chapter->url
			];
		$insert = $this->core->add_bookmark($data);
		if ($insert) :
			$json = [
				'status'	=> 'success',
				'title'		=> 'Good job!',
				'pesan'		=> 'Chapter berhasil dibookmark'
				];
		else :
			$json = [
				'status'	=> 'warning',
				'title'		=> 'Oops!',
				'pesan'		=> 'Chapter gagal dibookmark'
				];
		endif;
		echo json_encode($json);
	}

	private function add_data($data = NULL)
	{
		global $CFG;
		$default = ['config' => (object) $CFG->config];
		if (is_array($data)) return array_merge($default, $data);
		return $default;
	}
}
