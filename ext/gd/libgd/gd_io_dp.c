if (reremain >= len) {
		rlen = len;
	} else {
		if (reremain <= 0) {
			return EOF;
		}
		rlen = reremain
