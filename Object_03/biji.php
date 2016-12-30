一:自动验证
1.当前类模块是否有底层基类
App/http/controller/controller
2.在类模块相对于的方法 调用validate
3.格式
  <1>设置验证规则 对规则的描述
  	 $this->validate($request,[
    		//验证规则
    		'username'=>'required|regex:/\w{4,8}/|numeric'
    		],[
    		//规则的描述
    		'username.required'=>'用户名不能为空',
    		'username.regex'=>'请输入4-8位任意的数字字母下划线',
    		'username.numeric'=>'用户名只能是数字'
    		]);
   <2>显示错误信息  (自动存储在session里 $error)
   	 @if (count($errors) > 0)
		<div class="mws-form-message warning">                            
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
	    </div>
	@endif

	
二:哈希加密
1.导入Hash类  use Hash
2.加密数据  Hash::make
3.检测加密数据 Hash::check(输入数据,hash加密以后的数据);

三:分页
   （1）paginate 分页数据的显示
    (2)把分页的结果写入相对应试图里
四:搜索
    (1)设置form
    (2)当前类下当前方法里 
       DB::table("users")->where('username','like','%关键词%')->paginate(10);
    (3)在分页的结果里追加搜索参数
      appends($request) $request 分配过来的所有的参数信息

五:无限分类sql
  select *,concat(path,",",id) as paths from cates order by paths
六:创建请求类
(1)目录  app/Http/Requests
(2)创建请求类  php artisan make:request ArticleInsertRequest
(3)在请求类中开启权限
    public function authorize()
    {
        return true;
    }
(4)规则  
    public function rules()
    {
        return [
            //规则
            "title"=>'required'
        ];
    }
(5)规则的描述
   //对规则的描述
    public function messages(){
        return[
            "title.required"=>'标题不能为空'
        ];
    }
(6)显示错误信息
  @if (count($errors) > 0)
                          <div class="mws-form-message warning">                            
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  </div>
              @endif

七: 百度编辑器
1.引入js文件
<script type="text/javascript" charset="utf-8" src="/b/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/b/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/b/ueditor/lang/zh-cn/zh-cn.js"></script>
2.百度编辑器容器的代码
<script id="editor" type="text/plain"  name="content" style="width:700px;height:500px;"></script>
3.实例化编辑器
 <script type="text/javascript">
               //实例化编辑器
               //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
               var ue = UE.getEditor('editor');
                </script>