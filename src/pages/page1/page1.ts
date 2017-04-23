import { Component } from '@angular/core';
import { UserApi } from './../shared/user-api.service';


import { ModalController, ViewController, NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-page1',
  templateUrl: 'page1.html'
})
export class Page1 {

  receipt: any;


  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {
    this.receipt = navParams.get('receipt');
    console.log('Page1 loaded')
    console.log(this.receipt)
  }

  dismiss() {
   this.navCtrl.pop();
 }

}
