/* @pjs preload="images/americano.jpg,images/caffe_macchiato.jpg,images/caffe_mocha.jpg,images/cappuccino.jpg,images/caramel_latte.jpg,images/caramel_macchiato.jpg,images/darkchocolatemocha.jpg,images/espresso.jpg,images/havana_cappuccino.jpg,images/honey_lavender_latte.jpg,images/iced_caffe_mocha.jpg,images/iced_latte.jpg,images/iced_vanilla_latte.jpg,images/white_chocolate_mocha.jpg"; crisp=true;*/

//screen size
int[] screenC={1000,2000};
//usable screen size for images (width)
screenI=600;
//image size
int[] imageC={150,125};
//mouse variables
int[] mouseC={0,0}
var bPressed=false;
//this is preload string
String[] imageNames=split("images/americano.jpg,images/caffe_macchiato.jpg,images/caffe_mocha.jpg,images/cappuccino.jpg,images/caramel_latte.jpg,images/caramel_macchiato.jpg,images/darkchocolatemocha.jpg,images/espresso.jpg,images/havana_cappuccino.jpg,images/honey_lavender_latte.jpg,images/iced_caffe_mocha.jpg,images/iced_latte.jpg,images/iced_vanilla_latte.jpg,images/white_chocolate_mocha.jpg",',');
//array of actual images
PImage[] imageArray= new PImage[imageNames.length];
//populate array
for(var i=0;i<imageNames.length;i++;){
    imageArray[i]=loadImage(imageNames[i]);
}
//array for buttons clicked
String[] drinkNames={"Americano","CaffeMacchiato","CaffeMocha","Cappuccino","CaramelLatte","CaramelMacchiato","DarkChocolateMocha","Espresso","HavanaCappuccino","HoneyLavenderLatte","IcedCaffeMocha","IcedLatte","IcedVanillaLatte","WhiteChocolateMocha"};
String drinkSize="medium";

class CartObject {
    var itemName,cost, itemSize, clickableNum;
    CartObject(var itemNam, var itemSiz, var costt){
        itemName=itemNam;itemSize=itemSiz;cost=costt;
    }
}
CartObject[] cart={};

class Clickable {
    var minX, width, minY, height, cName, cFunction;
    Clickable(int mx, int mtx, int my, int mty, var cnam,var funcT){
        minX=mx;width=mtx;minY=my;height=mty;cName=cnam;cFunction=funcT;
    }
    void onClick(){

        //console.log(cFunction);
        cFunction(cName);
        
    }
    
}

//arrays for values of buttons
int[] imageXArray=new int[imageNames.length];
int[] imageYArray=new int[imageNames.length];
int[] buttonArray=new int[3];
//button
//boolean[] focusArray=new boolean[imageNames.length];

var extraText="";
//space in between images and outside of screen
int imageMargin=30;


var color1,color2,color3;
color1=100;color2=100;color3=100;

var numWide=Math.floor((screenI-imageMargin)/(imageC[0]+imageMargin));


//space on one side to center
var fullMargin=(screenI-(numWide*(imageC[0]+imageMargin)+imageMargin))/2;
//println(numWide+"what"+fullMargin);
var imageyY=40;



void removeObj(var cartNum){
    //move all array values past cartNum down 1, decrease array size by 1
    //do  clickable first because clickable number is stored in cart object

    //for some reason, removing all items errors the screen out.
    if(cart=={}){
       console.log("fuck"); 
    }
    if(cart.length!=null&&cart.length!=0&&cart.length!=1){
        console.log("not null");
        for(var i=(optionClick.length-1); i>(cart[cartNum].clickableNum); i--;){
            optionClick[i]=optionClick[i-1];
        }
        
        for(var i=cart[cartNum].clickableNum; i<(optionClick.length-1);i++;){
            optionClick[i]=optionClick[i+1];
        }
        optionClick=(Clickable[])shorten(optionClick);
        

        console.log("remove obj");
        if(cart.length!=1){
        for(var i=cartNum;i<(cart.length-1);i++;){
            cart[i]=cart[i+1];
        }
        cart=(CartObject[])shorten(cart);}else{
            cart=new CartObject();
        }
        
        //console.log(cart.length)
    }else{
        extraText="Cannot have empty cart";
    }
    
    
    //fix the clickable removing
    /*
    for(var i=cartNum;i<(cart.length-1);i++;){
        cart[i]=cart[i+1];
    }
    cart=(CartObject[])shorten(cart);
    */
}
void addCart(String itemName){
    //add stuff to cart array
    //console.log(itemName);
    if(cart.length==null){
        cart={};
    }
    cart=expand(cart,cart.length+1);
    //size is equal to selected size 
    //drinkSize="test";
    //get cost from Object dictionary in html script that gets data from php
    cart[cart.length-1]=new CartObject(itemName,drinkSize,costDict[itemName]);
    /*
    if(mouseC[0]>605 && mouseC[0]<645 && mouseC[1]>(55+(i*40)) && mouseC[1] < (95+(i*40)) ){
            fill(10);
    }
    */
    //add button to remove cart
    optionClick=(optionClick[])expand(optionClick,optionClick.length+1);
    optionClick[optionClick.length-1]=new Clickable(605,40,(55+((cart.length-1)*40)),40,(cart.length-1),removeObj);
    
    cart[cart.length-1].clickableNum=optionClick.length-1;
    //console.log((55*((cart.length-1)*40)));
    //console.log(optionClick.length);

    //console.log(drinkSize);
    //console.log(cart[cart.length-1].itemSize);
    //reset drink size to default medium
    drinkSize="medium";
    
}



void selectSize(var sizeName){
    drinkSize=sizeName;
}
Clickable submitButtond = new Clickable();
int[] subBut=new int(4);
void submitButton(x,y,width,height){
    /*
    fill(20,200,20);
    rect(x,y,width,height);
    */
    subBut[0]=x;subBut[1]=y;subBut[2]=width;subBut[3]=height;
    submitButtond=new Clickable(x,y,width,height,cart,submitCart);
    fill(10);
}

Clickable optionClick={};

void setup(){
    frameRate(60);
    size(screenC[0],screenC[1])
    background(255);
    noStroke();
    fill(100);
    submitButton(650,800,300,40);
    //size of drink buttons
    for(var i=0;i<3;i++;){

    }
    //populate array of image information
    for(var i=0;i<imageNames.length;i++;){
        var controlW=false;
        var testW=numWide;
        var row=1;
        while(!controlW){
            if((testW/i)<=1){
                testW+=numWide;
                row++;
            }else{
                //add coordinates of button to array
                imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-((row-1)*numWide))));
                imageYArray[i]=row*(imageyY)+((row-1)*imageC[1]);
                controlW=true;
                //add button to clickable objects array
                optionClick=(optionClick[])expand(optionClick,optionClick.length+1);
                optionClick[optionClick.length-1]=new Clickable(imageXArray[i]+5,imageC[0]-10,imageYArray[i]+5,imageC[1]-10,drinkNames[i],addCart);
            }
        }
    }
    optionClick=(optionClick[])expand(optionClick,optionClick.length+1);
    optionClick[optionClick.length-1]=submitButtond;
                

}


void draw(){
    background(255);
    fill(30,200,30);
    //submit button
    rect(subBut[0],subBut[1],subBut[2],subBut[3]);
    //draw drink/food option buttons
    for(var i=0;i<imageNames.length;i++;){
        fill(color1,color2,color3);


        //if mouse in between choice buttons
        if(mouseC[0]>=imageXArray[i]+5&&mouseC[0]<=(imageXArray[i]+imageC[0]-5)&&mouseC[1]>=imageYArray[i]+5&&mouseC[1]<=(imageYArray[i]+imageC[1]-5)){
            fill(0,0,0);
        }
        //added +100 for space for size modifier buttons
        rect(imageXArray[i],imageYArray[i],imageC[0],imageC[1]);
        image(loadImage(imageNames[i]),imageXArray[i]+5,imageYArray[i]+5,imageC[0]-10,imageC[1]-10);
    }
    stroke(30);
    strokeWeight(3);
    line(screenI,0,screenI,screenC[1])
    strokeWeight(0);
    //draw cart items
    fill(10);
    text("Items:            "+extraText,650, 20);
    if(cart.length!=null){
        //console.log("not null");
        for(var i=0;i<cart.length;i++){
            //fill(10);
            

            fill(200,10,30);
            //if mouse inbetween box (with added margins) change color
            if(mouseC[0]>605 && mouseC[0]<645 && mouseC[1]>(55+(i*40)) && mouseC[1] < (95+(i*40)) ){
                fill(10);
            }
            rect(610,60+(i*40),30,30);

            fill(10);
            text(cart[i].itemName+" - "+cart[i].itemSize+" - $"+cart[i].cost+" - "+cart[i].clickableNum,650,60+(i*40),100,30);
        }
    }
    //if a button is pressed
    if(bPressed){
        console.log("pressed");
        //replace mouceC[0] with mouseX if mouse X is updated constantly
        for(var i=0;i<optionClick.length;i++;){
            //console.log(i);
            //if mouse is in area of the button
            if( mouseC[0]>=optionClick[i].minX && mouseC[0]<= optionClick[i].minX+optionClick[i].width && mouseC[1]>=optionClick[i].minY && mouseC[1] <= optionClick[i].minY +optionClick[i].height){
                //do whatever function it is defined for.
                //when making items, should make those clickable too -> removable maybe somehow?
                //console.log(optionClick[i].minX);
                //if(mouse)
                optionClick[i].onClick();

            }
        }
        
        
        bPressed=false;
    }

    //rect(30,20,55,55);
    //rect(30,80,10,10);
}

void mouseMoved(){
    mouseC[0]=mouseX;
    mouseC[1]=mouseY;
}

void mouseReleased() {
    //mouseX, mouseY
    bPressed=true;
    mouseC[0]=mouseX;
    mouseC[1]=mouseY;
}