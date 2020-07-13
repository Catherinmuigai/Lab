const express= require ('express');
const app= express() ;
const port =processs.env.PORT || 3000;

app.use(_dirname+'./Public');
app.get('/',req,res,err)=>{
  res.send("Welcometo facebook");
  if (err)
  {
    consol.log('Error:'+err);
  }
});

app.listen(port) ;
console .log("listening on port"+port);
