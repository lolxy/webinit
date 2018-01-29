<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class VariableController extends AdminbaseController{
	
	protected $variable_model;
	//protected  $targets=array("_blank"=>"新标签页打开","_self"=>"本窗口打开");
	
	function _initialize() {
		parent::_initialize();
		$this->variable_model = D("Common/Variable");
	}
	
	function index(){
		$variable=$this->variable_model->order(array("listorder"=>"asc"))->select();
		$this->assign("variable",$variable);
		$this->display();
	}
	
	function add(){
		//$this->assign("targets",$this->targets);
		$this->display();
	}
	
	function add_post(){
		if(IS_POST){
			if ($this->variable_model->create()) {
				if ($this->variable_model->add()!==false) {
					$this->success("添加成功！", U("variable/index"));
				} else {
					$this->error("添加失败！");
				}
			} else {
				$this->error($this->variable_model->getError());
			}
		
		}
	}
	
	function edit(){
		$id=I("get.id");
		$variable=$this->variable_model->where("id=$id")->find();
		$this->assign($variable);
		//$this->assign("targets",$this->targets);
		$this->display();
	}
	
	function edit_post(){
		if (IS_POST) {
			if ($this->variable_model->create()) {
				if ($this->variable_model->save()!==false) {
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
			} else {
				$this->error($this->variable_model->getError());
			}
		}
	}
	
	//排序
	public function listorders() {
		$status = parent::_listorders($this->variable_model);
		if ($status) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}
	}
	
	//删除
	function delete(){
		if(isset($_POST['ids'])){
			
		}else{
			$id = intval(I("get.id"));
			if ($this->variable_model->delete($id)!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
	
	}
	
	
}