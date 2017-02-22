import { ServicesPage } from '../services/services';
import { ProductsPage } from '../products/products';
import { VaultPage } from './../vault/vault';
import { AccountsPage } from './../accounts/accounts';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  accountsTab = AccountsPage;
  vaultTab = VaultPage;
  productsTab = ProductsPage;
  servicesTab = ServicesPage;
  
  //backand just didn't play nice with iponic, looking at alternatives.
  constructor(public navCtrl: NavController, public navParams: NavParams) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad HomePage');
  }

}
