Current Inventory
=========================================================================================================

SELECT IL.ProductID
    ,P.ProductName
    ,IL.RestaurantID
    ,(SELECT RestaurantName FROM tblrestaurant R WHERE R.RestaurantID = IL.RestaurantID) as RestaurantName
    ,IL.TargetLevel
    ,( 	SELECT InventoryDate FROM tblinventoryhistory IH
        WHERE InventoryDate <= '2013-12-31'
        AND IH.ProductID = IL.ProductID
        AND IH.RestaurantID = IL.RestaurantID
        ORDER BY InventoryDate DESC
                ,IH.IHID DESC
        Limit 1) AS LastInventoryDate
    ,(	SELECT Quantity FROM tblInventoryHistory IH
        WHERE InventoryDate <= @ReportDate
        AND IH.ProductID = IL.ProductID
        AND IH.RestaurantID = IL.RestaurantID
        ORDER BY InventoryDate DESC
                ,IH.IHID DESC
        LIMIT 1) AS LastInventoryQty
    ,(  SELECT Sum(Quantity)
				FROM tblReceipt R
				INNER JOIN tblreceiptproduct RP ON R.ReceiptID = RP.ReceiptID
				WHERE RP.ProductID = IL.ProductID
        AND R.ReceivedDate BETWEEN (
										SELECT InventoryDate
										FROM tblInventoryHistory
										WHERE InventoryDate <= @ReportDate
											AND ProductID = IL.ProductID
											AND RestaurantID = IL.RestaurantID
										ORDER BY InventoryDate DESC
											,tblInventoryHistory.IHID DESC
										LIMIT 1)
								AND @ReportDate
    ) AS RecentReceipts
		-- Add CurrentLevel here
		-- Add OnOrder
FROM tblProduct P
LEFT JOIN tblInventoryLevel IL ON P.ProductID = IL.ProductID
ORDER BY P.ProductName
	,IL.RestaurantID;
	
=========================================================================================================

CurrentLevel = 
	,Nz((
			SELECT TOP 1 Quantity
			FROM tblInventoryHistory
			WHERE InventoryDate <= [Forms] ! [frmCurrentInventory] ! [txtReportDate]
				AND [ProductID] = IL ! [ProductID]
			ORDER BY InventoryDate DESC
				,tblInventoryHistory.IHID DESC
			), 0) 
	+ Nz((
			SELECT SUM(Quantity)
			FROM tblReceipt
			INNER JOIN tblReceiptProduct ON tblReceipt.ReceiptID = tblReceiptProduct.ReceiptID
			WHERE ProductID = IL.ProductID
				AND ReceivedDate BETWEEN (
							SELECT TOP 1 InventoryDate
							FROM tblInventoryHistory
							WHERE InventoryDate <= [Forms] ! [frmCurrentInventory] ! [txtReportDate]
								AND [ProductID] = IL ! [ProductID]
							ORDER BY InventoryDate DESC
								,tblInventoryHistory.IHID DESC
							)
					AND [Forms] ! [frmCurrentInventory] ! [txtReportDate]
			), 0) AS CurrentLevel

=========================================================================================================

	,Nz((
			SELECT Sum(Quantity)
			FROM tblOrder
			INNER JOIN tblOrderProduct ON tblOrder.OrderID = tblOrderProduct.OrderID
			WHERE ProductID = IL.ProductID
				AND tblOrder.OrderDate <= [Forms] ! [frmCurrentInventory] ! [txtReportDate]
			), 0) - Nz((
			SELECT Sum(Quantity)
			FROM tblReceipt
			INNER JOIN tblReceiptProduct ON tblReceipt.ReceiptID = tblReceiptProduct.ReceiptID
			WHERE ProductID = IL.ProductID
				AND tblReceipt.ReceivedDate <= [Forms] ! [frmCurrentInventory] ! [txtReportDate]
			), 0) AS OnOrder
			