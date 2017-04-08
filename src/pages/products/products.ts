import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserApi } from './../shared/user-api.service';

/*
  Generated class for the Products page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-products',
  templateUrl: 'products.html'
})
export class ProductsPage {

  private sub;
  public indexes;

  searchProductResults: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductsPage');
  }

  getProducts(searchbar){
     // set q to the value of the searchbar
    var q = searchbar.srcElement.value;
    if (!q) {
      return;
    }

    /*this.userApi.drugToSearch = q;
    //this.userApi.getProductData().then(data => this.searchProductResults = data);

    this.sub = this.userApi.getProductData().subscribe(
        data => this.indexes =  JSON.parse(data),
        error => alert(" Error is : " + error),
        () => console.log("finished")
     );*/

  }
}
