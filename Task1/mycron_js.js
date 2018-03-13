/**
 * Created by max on 11.03.2018.
 */
var mycron = function()
{
   // alert('test');
    //this yours script...
    setTimeout(arguments.callee,6*1000);
}
setTimeout(mycron,6*1000);