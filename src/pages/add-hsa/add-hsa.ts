import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams } from 'ionic-angular';
import { NgForm } from '@angular/forms/src/directives';
import { addHsaModel } from './../../models/addhsa.model';

@Component({
  selector: 'page-add-hsa',
  templateUrl: 'add-hsa.html'
})
export class AddHSAPage {

  model = new addHsaModel("", "");
  userinfo: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http) {
    this.userinfo = navParams.get('userinfo');
    console.log("userinfo passed from accounts: ", this.userinfo);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AddHSAPage');
  }

}
