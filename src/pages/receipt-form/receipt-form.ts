import { HsaTransactionPoster } from './../shared/receipt-HSAtransaction-post.service';
import { Component, ElementRef } from '@angular/core';
import { ModalController, ViewController, NavController, NavParams, LoadingController } from 'ionic-angular';
import { VaultPage } from './../vault/vault';
import { NgForm } from '@angular/forms/src/directives';
import { UserApi, User, AuthService, UserGlobals } from './../shared/user-api.service';
import { ReceiptModel } from './../../models/receiptForm.model';

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

  model = new ReceiptModel(this.userGlobals.getGlobalEmail(), this.userGlobals.getGlobalSession(), '0');

  searchJson: any;
  total: any;
  results: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public elementRef: ElementRef, public authService: AuthService, public user: User, public userGlobals: UserGlobals, public loadingController: LoadingController, public hsaTransactionPoster: HsaTransactionPoster) {
    this.searchJson = [
      {
        item: 'Product something',
        amount: '4.99'
      },
      {
        item: 'Something Product',
        amount: '2.59'
      },
      {
        item: 'This is Stupid',
        amount: '4.36'
      },
      {
        item: 'Almost done with this shit!',
        amount: '5.99'
      }
    ];
    
    //this.searchJson = this.userGlobals.getParsedPrices();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ReceiptFormPage');
    console.log(this.searchJson);
    console.log(this.CalculateTotal());
    this.model.totalPrice = this.CalculateTotal();
  }

  receipt = {
    totalPrice: this.total
  };

  receiptForm(form: NgForm) {
    this.model.totalPrice =this.CalculateTotal();

    console.log("Yay you hit submit");
    console.log("Total after changes: ", this.model.totalPrice);

    let loader = this.loadingController.create({
      content: 'Adding Account...'
    });

    loader.present().then(() => {
        console.log("this is the add", form.value);
        this.hsaTransactionPoster.postHsaAddForm(this.model)
        .subscribe(
          data => this.results = data,
          //err => console.log('error: ', err),
          () => console.log('results: ', this.results),
        );
        loader.dismiss();
        this.goBack();
    });
  }

  goBack() {
    this.navCtrl.pop();
  }

  CalculateTotal(): string{
    var total = 0;
    for (let item of this.searchJson){
      total += Number(item.amount);
    }
    return total.toString();
  }
}
