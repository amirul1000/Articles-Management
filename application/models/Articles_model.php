<?php

/**
 * Author: Amirul Momenin
 * Desc:Articles Model
 */
class Articles_model extends CI_Model
{
	protected $articles = 'articles';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get articles by id
	 *@param $id - primary key to get record
	 *
     */
    function get_articles($id){
        $result = $this->db->get_where('articles',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all articles
	 *
     */
    function get_all_articles(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('articles')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit articles
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_articles($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('articles')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count articles rows
	 *
     */
	function get_count_articles(){
       $result = $this->db->from("articles")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	/** Get limit articles
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_articles($limit, $start){
		$this->db->where('author_users_id', $this->session->userdata('id'));
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('articles')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count articles rows
	 *
     */
	function get_count_users_articles(){
	   $this->db->where('author_users_id', $this->session->userdata('id'));	
       $result = $this->db->from("articles")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new articles
	 *@param $params - data set to add record
	 *
     */
    function add_articles($params){
        $this->db->insert('articles',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update articles
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_articles($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('articles',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete articles
	 *@param $id - primary key to delete record
	 *
     */
    function delete_articles($id){
        $status = $this->db->delete('articles',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
