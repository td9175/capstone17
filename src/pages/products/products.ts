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

  searchJson: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductsPage');
    //this.loadsearch();
  }

  getProducts(searchbar){
     // set q to the value of the searchbar
    var q = searchbar.srcElement.value;
    if (!q) {
      return;
    }

    this.userApi.drugToSearch =  q;
    this.loadsearch();

    console.log(this.userApi.drugToSearch);
  }

  loadsearch(){
    this.userApi.getProductData().subscribe(
      result => {
        this.searchJson=result.data.candidates;
        console.log("Success : "+this.searchJson);
      },
      err =>{
        console.error("Error : "+err);
      } ,
      () => {
        console.log('getData completed');
      }
    );
  }
}
