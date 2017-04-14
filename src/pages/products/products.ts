import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserApi } from './../shared/user-api.service';
import { ProductDetail } from './../product-detail/product-detail';

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

  public searchJson: any;
  public success: any;
  public searchEmpty: any = true;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {}


  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductsPage');
    console.log('SearchEmpty Status: ', this.searchEmpty);
  }


  getProducts(searchbar){
    var q = searchbar.srcElement.value;
    if (!q) {
      this.searchEmpty = true;
      console.log("SearchEmpty Status: ", this.searchEmpty)
      return;
    } else {
      this.searchEmpty = false;
      this.userApi.drugToSearch = encodeURIComponent(q);
      console.log("SearchEmpty Status: ", this.searchEmpty)
      this.loadsearch();
    }
  }

  loadsearch(){
    this.userApi.getProductData().subscribe(
      result => {
        if (result.success === true) {
          this.searchJson=result.data.candidates;
          console.log("Returned Drug Data: ", this.searchJson);
          } else {
          this.success=false;
          console.log("Success Status: ", this.success);
        }
      },
      err =>{
        console.error("Error : "+err);
      } ,
    );
  }

  loadProductDetail(product){
    this.userApi.drugToGetDetails = product;
    this.navCtrl.push(ProductDetail);
  }
}
