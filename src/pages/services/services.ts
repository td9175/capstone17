import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams } from 'ionic-angular';
import { YelpPoster } from './../shared/yelp-api-post.service';
import { YelpSearchModel } from './../../models/yelpsearch.model';

/*
  Generated class for the Services page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-services',
  templateUrl: 'services.html'
})
export class ServicesPage {
  model = new YelpSearchModel('Dentist');
  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, private yelpPoster: YelpPoster) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad ServicesPage');

    };
  }
