import { Component } from '@angular/core';

import { ModalController, ViewController, NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-page1',
  templateUrl: 'page1.html'
})
export class Page1 {

  constructor(public navCtrl: NavController, public viewCtrl: ViewController) {
    
  }

  helloTest(){
    console.log('Hello, World!');
  }

  dismiss() {
   let data = { 'foo': 'bar' };
   this.viewCtrl.dismiss(data);
 }

}
