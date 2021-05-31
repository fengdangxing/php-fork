#php实现代码多进程-无参数
```php
Fork::Process(function(){
    //业务代码-子进程执行
})

#有参数
Fork::Process(function() use ($a,$b){
    //业务代码-子进程执行
})
```
#php依赖
pcntl

