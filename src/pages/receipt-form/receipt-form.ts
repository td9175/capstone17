import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserGlobals } from './../shared/user-api.service';

/*
  Generated class for the ReceiptForm page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-receipt-form',
  templateUrl: 'receipt-form.html'
})
export class ReceiptFormPage {

  searchJson: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userGlobals: UserGlobals) {
    this.searchJson = this.userGlobals.getParsedPrices();
    //this.searchJson = [{"item":" NGA USIOO","amount":"9.97"},{"item":" SPTSUNBLOCK","amount":"5.98"},{"item":" ALOE GEL","amount":"6.97"}];
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ReceiptFormPage');
    //this.searchJson = this.userGlobals.getParsedPrices();
    console.log(this.searchJson);
    //console.log(this.userGlobals.getParsedPrices());
  }

  totalUp(){
    var total= 0;
    var totalTwo =0;

    for (let item of this.searchJson) {
      console.log(parseFloat(item.amount));
      total += parseFloat(item.amount);
    }
    console.log(total);
  }

  

}
