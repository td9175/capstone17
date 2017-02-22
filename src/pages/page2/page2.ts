import { Component } from '@angular/core';

import { NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-page2',
  templateUrl: 'page2.html'
})
export class Page2 {
  selectedItem: any;
  icons: string[];
  items: Array<{title: string, note: string, icon: string}>;

  report: any;

  constructor(public navCtrl: NavController, private navParams: NavParams){
    this.report = this.navParams.data;
    console.log('**nav params:', this.navParams);
  }


}
