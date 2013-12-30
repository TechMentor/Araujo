-- Orders Add
INSERT INTO tblorder (OrderDate, VendorID, DueDate, RestaurantID, CreatedBy, CreatedOn)
VALUES(:OrderDate, :VendorID, :DueDate, :RestaurantID, :user, now());

INSERT INTO tblorderproduct (OrderID, ProductID, UnitPrice, Quantity, Comment)
VALUES (:OrderID, :ProductID, :UnitPrice, :Quantity, :Comment);

-- Orders, View Summary
SELECT 
  O.OrderID
  , O.OrderDate
  , O.VendorID
  , V.VendorName
  , OrderTotal(O.OrderID) TotalOrder
  , O.DueDate
  , O.RestaurantID
  , R.RestaurantName
FROM tblorder O
LEFT OUTER JOIN tblvendor V ON O.VendorID = V.VendorID
LEFT OUTER JOIN tblrestaurant R ON O.RestaurantID = R.RestaurantID

-- Orders, View Detail
SELECT 
  OP.OrderID
  , O.OrderDate
  , O.ProductID
  , P.ProductName
  , OP.UnitPrice
  , OP.Quantity
  , (OP.UnitPrice * OP.Quantity) ExtPrice
  , OP.Comment
  , V.VendorName
  , R.RestaurantName
FROM tblorderproduct OP
LEFT OUTER JOIN tblorder O on OP.OrderID = O.OrderID
LEFT OUTER JOIN tblProduct P on OP.ProductID = P.ProductID
LEFT OUTER JOIN tblvendor V ON O.VendorID = V.VendorID
LEFT OUTER JOIN tblrestaurant R ON O.RestaurantID = R.RestaurantID
