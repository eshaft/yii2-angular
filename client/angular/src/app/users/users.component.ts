import { Component, OnInit } from '@angular/core';
import {Breadcrumb} from "../breadcrumb/breadcrumb";

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css']
})
export class UsersComponent implements OnInit {
    breadcrumbLinks: Breadcrumb[] = [
        {link: '', label: 'Home'},
        {link: null, label: 'Users'}
    ];
  constructor() { }

  ngOnInit() {
  }

}
