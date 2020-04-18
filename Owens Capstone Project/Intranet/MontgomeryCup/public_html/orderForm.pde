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
string drinkSize="medium";

class CartObject {
    var itemName,itemSize,cost;
    CartObject(var itemNam, var itemSiz, var costt){
        itemName=itemNam;itemSize=itemSize;cost=costt;
    }
}
CartObject[] cart={};
class Clickable {
    var minX, width, minY, height, cName, cFunction;
    Clickable(int mx, int mtx, int my, int mty, String cnam,var funcT){
        minX=mx;width=mtx;minY=my;height=mty;cName=cnam;cFunction=funcT;
    }
    void onClick(){
        cFunction();
    }
}
//arrays for values of buttons
int[] imageXArray=new int[imageNames.length];
int[] imageYArray=new int[imageNames.length];
int[] buttonArray=new int[3];
//button
//boolean[] focusArray=new boolean[imageNames.length];


//space in between images and outside of screen
int imageMargin=30;


var color1,color2,color3;
color1=100;color2=100;color3=100;

var numWide=Math.floor((screenI-imageMargin)/(imageC[0]+imageMargin));


//space on one side to center
var fullMargin=(screenI-(numWide*(imageC[0]+imageMargin)+imageMargin))/2;
//println(numWide+"what"+fullMargin);
var imageyY=40;

void addCart(String itemName, String itemSize, var cost){
    //add stuff to cart array
    expand(cart,cart.length+1);
    cart[cart.length-1]=new CartObject(itemName,itemSize,cost);
}
void selectSize(var sizeName){
    drinkSize=sizeName;
}

Clickable optionClick={};

void setup(){
    frameRate(60);
    size(screenC[0],screenC[1])
    background(255);
    noStroke();
    fill(100);

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
                expand(optionClick,optionClick.length+1);
                optionClick[optionClick.length-1]=new Clickable(imageXArray[i]+5,imageC[0]-10,imageYArray[i]+5,imageC[1]-10,drinkNames[i]);
            }
        }
    }
}


void draw(){
    background(255);
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
    if(bPressed){
        
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