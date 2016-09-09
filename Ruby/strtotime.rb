require 'time'

# time like "2014-08-31 12:33:32" conver to unix timestamp.
def strtotime(date_str)
    return  Time.strptime(date_str, "%Y-%m-%d %H:%M:%S").to_i
end