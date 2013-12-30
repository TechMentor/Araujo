-- Receipt Add
INSERT INTO tblreceipt (ReceivedDate, VendorID, RestaurantID, CreatedBy, CreatedOn)
VALUES(:ReceivedDate, :VendorID, :RestaurantID, :user, now());

INSERT INTO tblreceiptproduct (ReceiptID, ProductID, UnitPrice, Quantity, Comment)
VALUES (:OrderID, :ProductID, :UnitPrice, :Quantity, :Comment, :user, now());

-- Receipt, View Summary
SELECT 
  R.ReceiptID
  , R.ReceivedDate
  , R.VendorID
  , V.VendorName
  , ReceiptTotal(O.OrderID) TotalOrder
  , R.RestaurantID
  , Rst.RestaurantName
FROM tblreceipt R
LEFT OUTER JOIN tblvendor V ON R.VendorID = V.VendorID
LEFT OUTER JOIN tblrestaurant Rst ON R.RestaurantID = Rst.RestaurantID

-- Receipt, View Detail
SELECT 
  R.ReceiptID
  , R.ReceivedDate  
  , RP.ProductID
  , P.ProductName
  , RP.UnitPrice
  , RP.Quantity
  , (RP.UnitPrice * RP.Quantity) ExtPrice
  , RP.Comment
  , V.VendorName
  , R.RestaurantName
FROM tblreceiptproduct RP
LEFT OUTER JOIN tblreceipt R on RP.OrderID = R.OrderID
LEFT OUTER JOIN tblProduct P on RP.ProductID = P.ProductID
LEFT OUTER JOIN tblvendor V ON R.VendorID = V.VendorID
LEFT OUTER JOIN tblrestaurant Rst ON R.RestaurantID = Rst.RestaurantID
