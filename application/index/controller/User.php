<?php
namespace app\index\controller;

use  \think\Controller;
use app\index\model\User as UserModel;
use \think\Validate;

class User extends Controller
{
	protected $user;
	public function _initialize()
	{
		$this->user = new UserModel();
	}
	public function index()
	{
		// $this->assign('info', $info);
		//session('name', 'huahua');
		//$this->assign(['name'=>'www','age'=>18]);
		//dump($this->request->param());
		//return $this->fetch();
		$this->redirect('user/info', ['cate_id' => 2]);
	}
	public function info()
	{
		// $nickname = $this->request->param('nickname');
		// $result = $this->user->get(['nickname'=>$nickname]);
		// if ($result) {
		// 	echo json_encode(['code'=>1, 'info'=>'有了']);
		// } else {
		// 	return json_encode(['code'=>0, 'info'=>'muyou了']);
		// }
		//return $this->fetch();
		// $validate = new Validate([
		// 	'name|用户名' => 'require|max:25',
		// 	'email' => 'email',

		// 	]);
		// $data = [
		// 	'name' => input('nickname'),
		// 	'email' => 'dfghjkl;.com'
		// ];
		// 	if (!$validate->check($data)) {
		// 	dump($validate->getError());
		// 	}
		//验证验证码
		// $validate = new Validate([
		// 	'captcha|验证码'=>'require|captcha'
		// ]);
		// $data = [
		// 	'captcha'=>input('cap'),
		// ];
		// 	if (!$validate->check($data)) {
		// 	dump($validate->getError());
		// 	} else {
		// 		dump('chengg');
		// 	}
		$list = $this->user->where('id', '>',20)->select();
		//echo json_encode($list);
		$this->assign('list', $list);
		return $this->fetch('infolist');
	}
	public function paging()
	{
		$this->success('执行成功!', 'user/index');
		
		// $list = $this->user->paginate(2, true);
		// // 获取分页显示
		// $page = $list->render();

		// $this->assign('list', $list);
		// $this->assign('page', $page);
		// return $this->fetch('info');
	}

	public function upload()
	{
		// 获取表单上传文件 例如上传了001.jpg
		$file = $this->request->file('image');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
			// 成功上传后 获取上传信息
			// 输出 jpg
			echo $info->getExtension();
			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
			echo $info->getSaveName();
			// 输出 42a79759f284b767dfcb2a0197904287.jpg
			echo $info->getFilename();
		}else{
			// 上传失败获取错误信息
			echo $file->getError();
		}
	}
}
