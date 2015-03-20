#Hair Salon
###Epicodus Assessment 3

Kyle Bulloch
03.20.2015

####Description

This app allows the user to create stylists in a hair salon.  The user can also
add clients to a specific stylist.  Stylists can be edited and deleted.  Clients
can be added and deleted.

####Setup

On a mac run these commands in your terminal:

git clone https://github.com/kbulloch/HairSalon.git

cd HairSalon/web

php -S localhost:8000

(then in a new terminal window)

postgres

(then in a new terminal tab)

psql

CREATE DATABASE hair_salon;

\c hair_salon;

CREATE TABLE stylists (id serial PRIMARY KEY, name varchar);

CREATE TABLE clients (id serial PRIMARY KEY, name varchar, stylist_id int);

CREATE DATABASE hair_salon_test WITH TEMPLATE hair_salon;


The MIT License

Copyright (c) 2015 Kyle Bulloch

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
