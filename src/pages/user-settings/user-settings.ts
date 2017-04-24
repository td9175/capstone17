import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams } from 'ionic-angular';
import { NgForm } from '@angular/forms/src/directives';

@Component({
  selector: 'page-user-settings',
  templateUrl: 'user-settings.html'
})
export class UserSettingsPage {

  userinfo: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http) {
    this.userinfo = navParams.get('userinfo');
    console.log("userinfo passed from accounts: ", this.userinfo)
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad UserSettingsPage');
  }

  goBack() {
    this.navCtrl.pop();
  }

}
