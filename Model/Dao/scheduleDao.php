<?php
class scheduleDao extends baseDao
{
	public static function instance()
	{
		return new scheduleDao();
	}
//Seat------------------------------------------------------------------------------------------------------------------------------------	
	public function seatUse($date)
	{
		$seatUse=array();
		$query= "SELECT seatNumber FROM seatbookingdetail WHERE startingDate<='$date' AND finishingDate>='$date' AND seatNumber is not null";
		$result=$this->executeSelect($query);
		while($row= mysqli_fetch_array($result))
		{
			$seatUse[]=$row['seatNumber'];
		}
		$this->DisConnectDB();
		return $seatUse;
	}
	public function seatEmpty($date)
	{
		$seatEmpty=array();
		$query= "SELECT code FROM seats WHERE code not in  
		(SELECT seatNumber FROM seatbookingdetail WHERE startingDate<='$date' AND finishingDate>='$date' AND seatNumber is not null)";
		$result=$this->executeSelect($query);
		while($row= mysqli_fetch_array($result))
		{
			$seatEmpty[]=$row['code'];
		}
		$this->DisConnectDB();
		return $seatEmpty;
	}
    public function seatNotYetAllocate($date)
    {
        $query = "select count(*) as count from seatbookingdetail JOIN orders ON seatbookingdetail.ordercode = orders.code 
                    WHERE seatNumber is null AND orderstate!=4 AND startingDate<='$date' AND finishingDate>='$date'";
        $result = $this->executeSelect($query);
        $row = mysqli_fetch_array($result);
        $count = "Need ".$row['count']." seat(s)";
        $this->DisConnectDB();
        return $count;
    }
//Team Room------------------------------------------------------------------------------------------------------------------------------------	
	public function TeamRoomUse($date)
	{
		$TeamRoomUse=array();
		$query= "SELECT roomNumber, roomType, name FROM teamroombookingdetail JOIN teamroomtypes 
              ON teamroomtypes.code = teamroombookingdetail.roomType 
              WHERE startingDate<='$date' AND finishingDate>='$date' AND roomNumber is not null";
		$result=$this->executeSelect($query);
		while($row= mysqli_fetch_array($result))
		{
			$TeamRoomUse[]=$row['roomNumber']." (Type: ".$row['roomType']."_".$row['name'].")";
		}
		$this->DisConnectDB();
		return $TeamRoomUse;
	}
	public function TeamRoomEmpty($date)
	{
		$TeamRoomEmpty=array();
		$query= "SELECT roomNumber, roomType, name FROM teamrooms JOIN teamroomtypes 
          ON teamrooms.roomType=teamroomtypes.code WHERE roomNumber not in  
		(SELECT roomNumber FROM teamroombookingdetail WHERE startingDate<='$date' AND finishingDate>='$date' AND roomNumber is not null)";
		$result=$this->executeSelect($query);
		while($row= mysqli_fetch_array($result))
		{
			$TeamRoomEmpty[]=$row['roomNumber']." (Type: ".$row['roomType']."_".$row['name'].")";
		}
		$this->DisConnectDB();
		return $TeamRoomEmpty;
	}
    public function TeamRoomNotYetAllocate($date)
    {
        $TeamRoomNotYetAllocate = array();
        $query = "select roomType, name, count(*) as count from teamroombookingdetail 
                    JOIN orders ON teamroombookingdetail.ordercode = orders.code 
                    JOIN teamroomtypes ON teamroomtypes.code= teamroombookingdetail.roomType 
                    WHERE teamroombookingdetail.roomNumber is null AND startingDate<='$date' AND finishingDate>='$date'
                    AND orderstate!=4 GROUP BY roomType";
        $result=$this->executeSelect($query);
        while($row= mysqli_fetch_array($result))
        {
            $TeamRoomNotYetAllocate[]= $row['roomType']." (".$row['name']."): need ".$row['count']." room(s)";
        }
        $this->DisConnectDB();
        return $TeamRoomNotYetAllocate;
    }
//Conference Room------------------------------------------------------------------------------------------------------------------------------------	
	public function ConfRoomUse($date,$hour)
	{ 
		$ConfRoomUse=array();
		$query= "SELECT roomNumber, roomType, name FROM conferenceroombookingdetail 
                    JOIN conferenceroomtypes ON conferenceroombookingdetail.roomType = conferenceroomtypes.code 
					WHERE date='$date' AND startingTime<='$hour' AND finishingTime>='$hour'  AND roomNumber is not null";
		$result=$this->executeSelect($query);
		while($row= mysqli_fetch_array($result))
		{
			$ConfRoomUse[]=$row['roomNumber']." (Type: ".$row['roomType']."_".$row['name'].")";
		}
		$this->DisConnectDB();
		return $ConfRoomUse;
	}
	public function ConfRoomEmpty($date,$hour)
	{
		$ConfRoomEmpty=array();
		$query= "SELECT roomNumber, roomType, name FROM conferencerooms 
        JOIN conferenceroomtypes ON conferencerooms.roomType = conferenceroomtypes.code 
        WHERE roomNumber not in (SELECT roomNumber FROM conferenceroombookingdetail 
		WHERE date='$date' AND startingTime<='$hour' AND finishingTime>='$hour' AND roomNumber is not null)";
		$result=$this->executeSelect($query);
		while($row= mysqli_fetch_array($result))
		{
			$ConfRoomEmpty[]=$row['roomNumber']." (Type: ".$row['roomType']."_".$row['name'].")";
		}
		$this->DisConnectDB();
		return $ConfRoomEmpty;
	}
    public function ConfRoomNotYetAllocate($date, $hour)
    {
        $ConfRoomNotYetAllocate = array();
        $query = "select roomType, name, COUNT(*) as count from conferenceroombookingdetail 
                        JOIN orders ON conferenceroombookingdetail.ordercode = orders.code 
                        JOIN conferenceroomtypes ON conferenceroombookingdetail.roomType = conferenceroomtypes.code 
                        WHERE conferenceroombookingdetail.roomNumber is null AND orderstate!=4 
                        AND date='$date' AND startingTime<='$hour' AND finishingTime>='$hour'
                        GROUP BY roomType";
        $result=$this->executeSelect($query);
        while($row= mysqli_fetch_array($result))
        {
            $ConfRoomNotYetAllocate[]= $row['roomType']." (".$row['name']."): need ".$row['count']." room(s)";
        }
        $this->DisConnectDB();
        return $ConfRoomNotYetAllocate;
    }
}
?>