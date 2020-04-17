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
//arrays for values of buttons
int[] imageXArray=new int[imageNames.length];
int[] imageYArray=new int[imageNames.length];
//int[] buttonArray={0,0,0}
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

void setup(){
    frameRate(60);
    size(screenC[0],screenC[1])
    background(255);
    noStroke();
    fill(100);
    //println("testing");

    for(var i=0;i<3;i++;){

    }
    //populate array of image information
    for(var i=0;i<imageNames.length;i++;){
        //imageArray[0]=loadImage("name.jpg");
        //image(variable,x,y,width,height);
        var controlW=false;
        var testW=numWide;
        var row=1;
        while(!controlW){
            if((testW/i)<=1){
                testW+=numWide;
                row++;
            }else{
                imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-((row-1)*numWide))));
                imageYArray[i]=row*(imageyY)+((row-1)*imageC[1]);
                controlW=true;
            }
        }
        
        /*
        //POSSIBLE CHANGE THE Y THROUGH MODULOUS/MATH.FLOOR INSTEAD OF IF STATEMENTS
        if((numWide/i)<=(1/8)){
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-(8*numWide))));
            imageYArray[i]=5*(imageyY)+(4*imageC[1]);
        }else if((numWide/i)<=(1/4)){
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-(4*numWide))));
            imageYArray[i]=4*(imageyY)+(3*imageC[1]);
            console.log("yet");
        }
        else if((numWide/i)<=(1/2)){  
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-(2*numWide))));
            imageYArray[i]=3*(imageyY)+(2*imageC[1]);
        }else if((numWide/i)<=1){
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-numWide)));
            imageYArray[i]=2*(imageyY)+imageC[1];
            //println(imageyY);
            //console.log(imageyY);
        }else{
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*i));
            imageYArray[i]=imageyY;
        }
        */
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
    stroke(30   );
    strokeWeight(3);
    line(screenI,0,screenI,screenC[1])
    strokeWeight(0);
    //rect(30,20,55,55);
    //rect(30,80,10,10);
}

void mouseReleased() {
    //mouseX, mouseY
    bPressed=true;
}

void mouseMoved(){
    mouseC[0]=mouseX;
    mouseC[1]=mouseY;
}