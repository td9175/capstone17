import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-user-settings',
  templateUrl: 'user-settings.html'
})
export class UserSettingsPage {

  constructor(public navCtrl: NavController, public navParams: NavParams) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad UserSettingsPage');
  }

  

}
