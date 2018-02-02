function MyAdapter(){
    var mysql      = require('mysql');
    this.connection = mysql.createConnection({
        host     : '39.106.138.89',
        user     : 'root',
        password : '12345678',
        database : 'hf1707_zc'
    });
    this.connection.connect();
}

//增删改
MyAdapter.prototype.run=function(sql,params,callback){
    this.connection.query(sql,params,function(err){
        if(err)
        {
            callback(false,err);
            console.log("执行sql语句失败",err);
        }
        else{
            callback(true,this);
        }
    });
};
//查
MyAdapter.prototype.all=function(sql,params,callback){
    this.connection.query(sql,params,function(err,rows){
        if(err)
        {
            console.log("执行sql语句失败",err);
            callback(false,err);
        }
        else{
            callback(true,rows);
        }
    });
};

module.exports=new MyAdapter();