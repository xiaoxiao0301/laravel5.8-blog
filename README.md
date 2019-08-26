# Laravel 5.8 博客实战

> 主要用到的知识点有：
- 资源路由
- 路由模型绑定
- ORM模型关联
- 视图共享数据
- 自定义分页实现
- 百度文本编辑器导入
- webuploader实现文件异步上传
- ajax异步刷新文章排序、删除数据
- RequestForm表单类进行表单验证
- mews/captcha 验证码包简单使用

> 使用
1. 将项目git clone 下来导入到网站的根目录
2. 配置虚拟主机指向项目目录下的public文件夹
3. 运行 composer install 下载所有的依赖包文件
4. 运行 php artisan migrate 生成表数据库文件
5. 运行 php artisan db:seed 生成管理员初始账号和密码
6. 运行 php artisan  ide-helper:generate 生成快捷帮助

> 初始账号
- name : demon
- pass: 123456

