# softdd/task
任务管理类
## Installation
```bash
composer require softdd/task
php artisan vendor:publish --provider="SoftDD\Task\DocMakerServiceProvider
```

## Usage
自定义类，扩展Task的功能
自定义类，扩展TaskController的功能

### 配置说明
```php
//softDDRequestLog.php
return [
    'apiScanPath'=>app_path()."/Api",
    'docType'=>'json', //json or yaml
    'docPath'=>storage_path('docs')."/doc.json",
    'uri'=>'/api/docs',
    'middleware'=>[],
];
```
- apiScanPath 生成文档需要扫描的目录
- docType  生成文档的类型, json or yaml
- docPath  稳定保存的目录，注意需要有读写权限
- uri 访问文档的路径，注意不可和已经路由冲突。force参数可强制更新
- middleware 文档路由的中间件，可增加相关处理，比如授权等。默认为空
