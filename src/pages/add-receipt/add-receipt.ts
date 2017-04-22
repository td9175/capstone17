import { Component } from '@angular/core';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { Camera } from '@ionic-native/camera';
import { Http, Headers } from '@angular/http';

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



  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, private loadingController: LoadingController, private camera: Camera) {
    //this.receiptImage = this.image_fire()
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AddReceiptPage');
  }

  goBack() {
    this.navCtrl.pop();
  }
}
