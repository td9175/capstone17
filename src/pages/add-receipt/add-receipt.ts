import { AppNgModuleInfo } from '@ionic/app-scripts/dist';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Camera } from 'ionic-native';

/*
  Generated class for the AddReceipt page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-add-receipt',
  templateUrl: 'add-receipt.html'
})
export class AddReceiptPage {

  constructor(public navCtrl: NavController, public navParams: NavParams, private camera: Camera) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad AddReceiptPage');
  }

  goBack() {
    this.navCtrl.pop();
  }

  takePicture(){
    var options = {
      quality: 50,
      destinationType: 0,
      sourceType: 1, //0:Photo Library, 1=camera, 2 = Saved photo album
      encodingType: 1 //0=jpg 1=png
    }

    Camera.getPicture(options).then((imageData) => {
      let base64Image = 'data:image/png;base64,' + imageData;
      console.log("here's your sign")
      console.log(base64Image)
    }, (err) => {
      console.log("Shit")
    });
  }

}
