import { Page2 } from './../page2/page2';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

/*
  Generated class for the Reports page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-reports',
  templateUrl: 'reports.html'
})
export class ReportsPage {

  reports = [
    { id: 1, name: 'Awesome Name'},
    { id: 2, name: 'Great Title'},
    { id: 3, name: 'Fred & Sue'}
  ]

  constructor(public navCtrl: NavController, public navParams: NavParams) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad ReportsPage');
  }

  itemTapped($event, report){
    this.navCtrl.push(Page2, report);
  }

  goHome(){
    //this.nav.push(MyTeamsPage);
    //this.navCtrl.popToRoot();
  }
}
